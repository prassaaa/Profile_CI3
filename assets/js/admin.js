// Toggle sidebar
document.getElementById('toggleSidebar').addEventListener('click', function() {
    document.body.classList.toggle('collapsed');
});

// Auto hide alerts after 5 seconds
setTimeout(function() {
    var alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        bootstrap.Alert.getOrCreateInstance(alert).close();
    });
}, 5000);

// Image preview
function previewImage(input, previewId) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
            document.getElementById(previewId).src = e.target.result;
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}

// Confirm delete
function confirmDelete(url, name) {
    if (confirm('Apakah Anda yakin ingin menghapus "' + name + '"?')) {
        window.location.href = url;
    }
}
