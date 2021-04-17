<footer class="flex w-full border-t-2 border-gray-200 px-4 mt-auto lg:px-0">
    <div class="flex flex-wrap justify-center sm:justify-between items-center md:space-x-6 w-full max-w-screen-lg py-4 mx-auto">
        <a href="{{ route('home') }}" class="footer__link">Minecraft Маркет &copy 2020-{{ date('Y') }}</a>
        <div class="flex flex-col md:flex-row flex-wrap items-center md:space-x-4">
            <a href="{{ route('contact') }}" class="footer__link">Контакты</a>
            <a href="{{ route('terms') }}" class="footer__link">Условия и правила</a>
            <a href="{{ route('privacy') }}" class="footer__link">Политика конфиденциальности</a>
        </div>
    </div>
</footer>