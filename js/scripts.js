// 表单验证
document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(event) {
            const inputs = form.querySelectorAll('input[type="text"], input[type="password"], input[type="email"]');
            let valid = true;
            inputs.forEach(input => {
                if (input.value.trim() === '') {
                    valid = false;
                    input.style.borderColor = 'red';
                } else {
                    input.style.borderColor = '#ddd';
                }
            });
            if (!valid) {
                event.preventDefault();
                alert('请填写所有字段');
            }
        });
    });
    
    // 动态内容加载
    loadProducts();
    loadNewProducts();
});

function loadProducts() {
    fetch('product_list.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('product-list').innerHTML = data;
        })
        .catch(error => console.error('Error:', error));
}

function loadNewProducts() {
    fetch('new_list.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('new-product-list').innerHTML = data;
        })
        .catch(error => console.error('Error:', error));
}