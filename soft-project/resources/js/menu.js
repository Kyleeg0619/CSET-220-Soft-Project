function showMenu() {
    document.getElementById("menu-icon").addEventListener('click',function(){
        document.querySelector('.nav-links').classList.toggle('visible');
    });
}

showMenu();