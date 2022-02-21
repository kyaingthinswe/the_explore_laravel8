require('./bootstrap');
window.VenoBox = require("venobox");

function logout(e) {
    e.preventDefault();
    document.getElementById('logout-form').submit();

}
