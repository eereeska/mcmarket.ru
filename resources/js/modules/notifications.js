import mcm from "../mcm";

var n = function() {
    this.container = this.getContainer();
}

n.prototype.getContainer = function() {
    return mcm.qs('body > .notifications') || document.body.appendChild(document.createElement('div').classList.add('notifications'));
}

export default new n();