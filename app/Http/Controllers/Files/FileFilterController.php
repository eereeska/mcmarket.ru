<?php

namespace App\Http\Controllers\Files;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;

class FileFilterController extends Controller
{
    public static function filter(Request $request, $categories, User $user = null, $for_guests = true, $per_page = 20)
    {
        if (is_null($categories)) {
            $categories = FileCategoryController::getCategories();
        }

        // TODO: Cache

        $files = File::query();

        if ($user) {
            $files = $files->where('user_id', $user->id);
        }
        
        if ($for_guests) {
            $files = $files->where('state', 'visible');
        }

        $files = $files->when($request->get('from'), function($query) use ($request) {
            return $query->where('user_id', $request->from);
        });

        $files = $files->when(in_array($request->get('category'), $categories->pluck('name')->toArray()), function($query) use ($request, $categories) {
            return $query->where('category_id', $categories->where('name', $request->category)->pluck('id'));
        });

        $files = $files->when(in_array($request->get('type'), ['free', 'paid', 'nulled']), function ($query) use ($request) {
            return $query->where('type', $request->type);
        });

        $files = $files->when(in_array($request->get('status'), ['hidden', 'pending', 'approved']), function ($query) use ($request) {
            if ($request->status == 'hidden') {
                return $query->where([
                    'is_visible' => false,
                    'is_approved' => false
                ]);
            } else if ($request->status == 'pending') {
                return $query->where('is_visible', true);
            } else if ($request->status == 'approved') {
                return $query->where('is_approved', true);
            }
        });

        $sort = [
            'update_up' => 'version_updated_at',
            'update_down' => 'version_updated_at',
            'new_up' => 'created_at',
            'new_down' => 'created_at',
            'downloads_up' => 'downloads_count',
            'downloads_down' => 'downloads_count',
            'views_up' => 'views_count',
            'views_down' => 'views_count'
        ];

        $files = $files->when(array_key_exists($request->get('sort'), $sort), function ($query) use ($request, $sort) {
            return $query->orderBy($sort[$request->sort], str_contains($request->sort, '_up') ? 'asc' : 'desc');
        }, function($query) {
            return $query->orderBy('version_updated_at', 'desc');
        });

        return $files->with([
            'category' => function($query) {
                return $query->select(['id', 'name', 'title']);
            }, 'user' => function($query) {
                return $query->select(['id', 'name']);
            }
        ])->paginate($per_page)->appends($request->only(['category', 'type', 'sort']));
    }
}