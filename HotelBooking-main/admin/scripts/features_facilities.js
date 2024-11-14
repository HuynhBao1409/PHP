// Định nghĩa hàm alert
function alert(type, msg) {
    let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
    let element = document.createElement('div');
    element.innerHTML = `
        <div class="alert ${bs_class} alert-dismissible fade show custom-alert" role="alert">
            <strong>${msg}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;
    document.body.append(element);
    setTimeout(function() {
        element.remove();
    }, 2000);
}

// Khởi tạo khi DOM đã load
document.addEventListener('DOMContentLoaded', function() {
    let feature_s_form = document.getElementById('feature_s_form');
    let facility_s_form = document.getElementById('facility_s_form');

    if(feature_s_form) {
        feature_s_form.addEventListener('submit', function(e) {
            e.preventDefault();
            add_feature();
        });
    }

    if(facility_s_form) {
        facility_s_form.addEventListener('submit', function(e) {
            e.preventDefault();
            add_facility();
        });
    }

    // Gọi hàm khởi tạo
    get_features();
    get_facilities();
});

function add_feature() {
    let feature_s_form = document.getElementById('feature_s_form');
    if(!feature_s_form) return;

    let data = new FormData();
    data.append('name', feature_s_form.elements['feature_name'].value);
    data.append('add_feature', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities.php", true);

    xhr.onload = function() {
        var myModal = document.getElementById('feature-s');
        if(myModal) {
            var modal = bootstrap.Modal.getInstance(myModal);
            if(modal) modal.hide();
        }

        if (this.responseText == 1) {
            alert('success', 'Thêm tính năng mới thành công!');
            feature_s_form.elements['feature_name'].value = '';
            get_features();
        } else {
            alert('error', 'Lỗi server!');
        }
    }

    xhr.onerror = function() {
        alert('error', 'Không thể kết nối đến server!');
    };

    xhr.send(data);
}

function get_features() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        let features_data = document.getElementById('features_data');
        if(features_data) {
            features_data.innerHTML = this.responseText;
        }
    }

    xhr.onerror = function() {
        alert('error', 'Không thể kết nối đến server!');
    };

    xhr.send('get_features');
}

function rem_feature(val) {
    if(!val) return;

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        if (this.responseText == 1) {
            alert('success', 'Đã xóa tính năng!');
            get_features();
        } else if (this.responseText == 'room-added') {
            alert('error', 'Tính năng đang được sử dụng trong phòng!');
        } else {
            alert('error', 'Lỗi server!');
        }
    }

    xhr.onerror = function() {
        alert('error', 'Không thể kết nối đến server!');
    };

    xhr.send('rem_feature=' + val);
}

function add_facility() {
    let facility_s_form = document.getElementById('facility_s_form');
    if(!facility_s_form) return;

    let data = new FormData();
    data.append('name', facility_s_form.elements['facility_name'].value);
    data.append('icon', facility_s_form.elements['facility_icon'].files[0]);
    data.append('desc', facility_s_form.elements['facility_desc'].value);
    data.append('add_facility', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities.php", true);

    xhr.onload = function() {
        var myModal = document.getElementById('facility-s');
        if(myModal) {
            var modal = bootstrap.Modal.getInstance(myModal);
            if(modal) modal.hide();
        }

        if (this.responseText == 'inv_img') {
            alert('error', 'Chỉ cho phép file SVG!');
        } else if (this.responseText == 'inv_size') {
            alert('error', 'Kích thước file phải nhỏ hơn 1MB!');
        } else if (this.responseText == 'upd_failed') {
            alert('error', 'Tải ảnh lên thất bại!');
        } else if (this.responseText == '1') {
            alert('success', 'Thêm tiện ích mới thành công!');
            facility_s_form.reset();
            get_facilities();
        } else {
            alert('error', 'Thêm tiện ích thất bại! Lỗi: ' + this.responseText);
        }
    }

    xhr.onerror = function() {
        alert('error', 'Không thể kết nối đến server!');
    };

    xhr.send(data);
}

function get_facilities() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        let facilities_data = document.getElementById('facilities_data');
        if(facilities_data) {
            facilities_data.innerHTML = this.responseText;
        }
    }

    xhr.onerror = function() {
        alert('error', 'Không thể kết nối đến server!');
    };

    xhr.send('get_facilities');
}

function rem_facility(val) {
    if(!val) return;

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        if (this.responseText == 1) {
            alert('success', 'Đã xóa tiện ích!');
            get_facilities();
        } else if (this.responseText == 'room-added') {
            alert('error', 'Tiện ích đang được sử dụng trong phòng!');
        } else {
            alert('error', 'Lỗi server!');
        }
    }

    xhr.onerror = function() {
        alert('error', 'Không thể kết nối đến server!');
    };

    xhr.send('rem_facility=' + val);
}