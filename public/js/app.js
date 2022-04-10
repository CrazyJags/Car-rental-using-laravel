const sideBarCollapseButton = document.querySelector('#sidebarCollapse');
const sideBarCollapseIcon = document.querySelector('.toggleSidebar');
const sidebar = document.querySelector('#sidebar');
const hideSideBarClass = 'fa-arrow-circle-right';
const showSideBarClass = 'fa-arrow-circle-left';
const sideBarTextSpan = document.querySelector('#sidebarIndication');

const hideOrShowSidebar = () => {
    const isActive = !sidebar.classList.toggle('active');
    if(isActive) {
        sideBarTextSpan.textContent = 'Hide sidebar';
        sideBarCollapseIcon.classList.replace(hideSideBarClass,showSideBarClass);
    }
    else {
        sideBarTextSpan.textContent = 'Toggle sidebar';
        sideBarCollapseIcon.classList.replace(showSideBarClass,hideSideBarClass);
    }
};
sideBarCollapseButton.addEventListener('click',hideOrShowSidebar);
