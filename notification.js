// notifications.js

// Notification icon functionality
const notificationIcon = document.getElementById('notification-icon');
const notificationModal = document.getElementById('notification-modal');
const closeBtn = document.querySelector('.close');
const notificationCount = document.getElementById('notification-count');
const notificationList = document.getElementById('notification-list');
let count = 0;

notificationIcon.addEventListener('click', () => {
    const iconRect = notificationIcon.getBoundingClientRect();
    const modalWidth = 200; // Width of the modal content

    let modalLeft = iconRect.left - modalWidth + iconRect.width / 2 - 20;

    if (modalLeft < 0) {
        modalLeft = 0;
    }

    notificationModal.style.top = (iconRect.bottom + 10) + 'px';
    notificationModal.style.left = modalLeft + 'px';
    notificationModal.style.display = 'block';
    count = 0;
    updateNotificationCount();
});

closeBtn.addEventListener('click', () => {
    notificationModal.style.display = 'none';
});

window.addEventListener('click', (e) => {
    if (e.target == notificationModal) {
        notificationModal.style.display = 'none';
    }
});

function updateNotificationCount() {
    notificationCount.textContent = count;
}

function addNotification(notification) {
    const li = document.createElement('li');
    li.textContent = notification;
    notificationList.appendChild(li);
}

function receiveNotification() {
    count++;
    updateNotificationCount();
    addNotification('New notification');
}

// Example: Simulating receiving notifications
receiveNotification();
receiveNotification();
// Call receiveNotification() whenever a new notification arrives.