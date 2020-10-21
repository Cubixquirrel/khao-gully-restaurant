function pageBack() {
    window.history.back();
}

function openAddCategory() {
    window.location.href = '../views/add-category.php';
}

var type = document.querySelector('[name="type"]');
var category = document.querySelector('[name="category"]');
var foodName = document.querySelector('#food-name');
var price = document.querySelector('#price');
var description = document.querySelector('#description');
var updateButton = document.querySelector('#update-button');
var allInput = document.querySelectorAll('input');
var allLabel = document.querySelectorAll('.label');

function switchType() {
    var typeBox = document.querySelectorAll('.type-box');
    var currentTypeBox = event.currentTarget;

    for (var i = 0; i < typeBox.length; i++) {
        typeBox[i].setAttribute('class', 'type-box');
        typeBox[i].setAttribute('data-selected', '');
    }

    currentTypeBox.setAttribute('class', 'type-box active');
    currentTypeBox.setAttribute('data-selected', 'true');

    type.value = currentTypeBox.getAttribute('data-type-id');
    
    updateButton.style.background = '#03a9f4';
    updateButton.style.color = '#ffffff';
}

function switchCategory() {
    var categoryBox = document.querySelectorAll('.category-box');
    var currentCategoryBox = event.currentTarget;

    for (var i = 0; i < categoryBox.length; i++) {
        categoryBox[i].setAttribute('class', 'category-box');
        categoryBox[i].setAttribute('data-selected', '');
    }

    currentCategoryBox.setAttribute('class', 'category-box active');
    currentCategoryBox.setAttribute('data-selected', 'true');

    category.value = currentCategoryBox.getAttribute('data-category-id');

    updateButton.style.background = '#03a9f4';
    updateButton.style.color = '#ffffff';
}

function enableButton(number) {    
    if (number == '1') {
        if (
            (foodName.value.length >= 1) && 
            (price.value.length >= 1) && 
            (description.value.length >= 1)
        ) {
            updateButton.style.background = '#03a9f4';
            updateButton.style.color = '#ffffff';
        } else {
            updateButton.style.background = '#dddddd';
            updateButton.style.color = '#999999';
        }
    }
}

function updateItem(foodId) {
    updateButton.value = 'Please Wait';
    updateButton.setAttribute('disabled', 'disabled');
    updateButton.style.background = '#dddddd';
    updateButton.style.color = '#999999';

    if (
        (foodName.value.length >= 1) && 
        (price.value.length >= 1) && 
        (description.value.length >= 1)
    ) {
        for (var i = 0; i < allLabel.length; i++) {
            allLabel[i].style.color = '#0f0f0f';
        }

        var http = new XMLHttpRequest();
        var url = '../requests/update-item.php';
        var params = 
        'foodId='+foodId+
        '&type='+type.value+
        '&category='+category.value+
        '&foodName='+foodName.value+
        '&price='+price.value+
        '&description='+description.value
        ;

        http.open('POST', url, true);
        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        http.onreadystatechange = function() {
            if(http.readyState == 4 && http.status == 200) {
                // console.log(http.responseText);
                if(http.responseText == 'true') {
                    setTimeout(function() {
                        updateButton.value = 'Updated';
                        updateButton.style.background = '#03a9f4';
                        updateButton.style.color = '#ffffff';

                        setTimeout(() => {
                            window.history.back();
                        }, 1000);
                    }, 2000);
                }
            }
        }
        http.send(params);
    } else {
        setTimeout(function() {
            updateButton.value = 'Update';
            updateButton.removeAttribute('disabled');

            if (foodName.value == '') {
                allLabel[1].style.color = '#FF5722';
            } else {
                allLabel[1].style.color = '#0f0f0f';
            }

            if (price.value == '') {
                allLabel[2].style.color = '#FF5722';
            } else {
                allLabel[2].style.color = '#0f0f0f';
            }

            if (description.value == '') {
                allLabel[3].style.color = '#FF5722';
            } else {
                allLabel[3].style.color = '#0f0f0f';
            }
        }, 1000);
    }
}