function toggleSidebar()
{
    coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()
}

let headerToggle = document.getElementById('header-toggler');

headerToggle.addEventListener('click', toggleSidebar);
