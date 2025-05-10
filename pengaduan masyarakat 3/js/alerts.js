function showAlert(message, type = 'info') {
    const alert = document.createElement('div');
    alert.className = `custom-alert ${type}`;
    
    // Icon based on alert type
    let icon = '';
    switch(type) {
        case 'success':
            icon = '✓';
            break;
        case 'error':
            icon = '✕';
            break;
        case 'warning':
            icon = '⚠';
            break;
        case 'info':
            icon = 'ℹ';
            break;
        case 'loading':
            icon = '↻';
            break;
    }
    
    alert.innerHTML = `<span class="alert-icon">${icon}</span><span>${message}</span>`;
    document.body.appendChild(alert);

    // Don't auto-remove if it's a loading alert
    if (type !== 'loading') {
        setTimeout(() => {
            alert.remove();
        }, 3000);
    }

    return alert; // Return the alert element for potential removal later
}

function showConfirm(message, callback) {
    // Create semi-transparent overlay
    const overlay = document.createElement('div');
    overlay.className = 'confirm-overlay';
    document.body.appendChild(overlay);

    const confirmBox = document.createElement('div');
    confirmBox.className = 'custom-alert confirm';
    confirmBox.style.animation = 'none';
    confirmBox.style.opacity = '1';
    
    const content = document.createElement('div');
    content.className = 'confirm-content';
    content.innerHTML = `
        <p>${message}</p>
        <div class="confirm-buttons">
            <button class="confirm-yes">Ya</button>
            <button class="confirm-no">Tidak</button>
        </div>
    `;
    
    confirmBox.appendChild(content);
    document.body.appendChild(confirmBox);
    
    const yesBtn = confirmBox.querySelector('.confirm-yes');
    const noBtn = confirmBox.querySelector('.confirm-no');
    
    function cleanup() {
        document.body.removeChild(confirmBox);
        document.body.removeChild(overlay);
    }
    
    yesBtn.addEventListener('click', () => {
        cleanup();
        callback(true);
    });
    
    noBtn.addEventListener('click', () => {
        cleanup();
        callback(false);
    });

    // Close on overlay click
    overlay.addEventListener('click', () => {
        cleanup();
        callback(false);
    });
}

// Handle AJAX errors
window.addEventListener('error', function(e) {
    showAlert('Terjadi kesalahan: ' + e.message, 'error');
});