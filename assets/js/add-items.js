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
var addButton = document.querySelector('#add-button');
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
}

function enableButton(number) {    
    if (number == '1') {
        if (
            (foodName.value.length >= 1) && 
            (price.value.length >= 1) && 
            (description.value.length >= 1)
        ) {
            addButton.style.background = '#03a9f4';
            addButton.style.color = '#ffffff';
        } else {
            addButton.style.background = '#dddddd';
            addButton.style.color = '#999999';
        }
    }
}

function addItems(restaurantId) {
    addButton.value = 'Please Wait';
    addButton.setAttribute('disabled', 'disabled');
    addButton.style.background = '#dddddd';
    addButton.style.color = '#999999';

    if (
        (foodName.value.length >= 1) && 
        (price.value.length >= 1) && 
        (description.value.length >= 1)
    ) {
        for (var i = 0; i < allLabel.length; i++) {
            allLabel[i].style.color = '#0f0f0f';
        }

        var http = new XMLHttpRequest();
        var url = '../requests/add-items.php';
        var params = 
        'restaurantId='+restaurantId+
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
                        addButton.value = 'Added';
                        addButton.style.background = '#03a9f4';
                        addButton.style.color = '#ffffff';

                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    }, 2000);
                }
            }
        }
        http.send(params);
    } else {
        setTimeout(function() {
            addButton.value = 'Add';
            addButton.removeAttribute('disabled');

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