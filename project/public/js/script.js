// --------------------- Type Switcher ---------------------

let select = document.getElementById('productType');
let currentType = select.value;
let currentElement = document.getElementById(currentType);

enableFields(currentElement);
currentElement.style.display = 'flex';

function showFields()
{
    currentType = select.value;
    let lastElement = currentElement;
    currentElement = document.getElementById(currentType);

    lastElement.style.display = 'none';
    disableFields(lastElement);

    enableFields(currentElement);
    currentElement.style.display = 'flex';
}

function enableFields(element)
{
    element.querySelectorAll('input').forEach(
        function (input) {
            input.disabled = false;
        }
    );
}

function disableFields(element)
{
    element.querySelectorAll('input').forEach(
        function (input) {
            input.disabled = true;
        }
    );
}

// --------------------- Form validation ---------------------

let fieldsToValidate = document.querySelectorAll('#product_form .checkValidity');
fieldsToValidate.forEach(function (field) {
    field.addEventListener('input', function () {
        validate(this);
    })
});

document.getElementById('product_form').addEventListener('submit', function (e) {
    e.preventDefault();
    let isFormValid = true;

    fieldsToValidate.forEach(function (field) {
        if (!field.disabled) {
            if (!field.classList.contains('was-validated')) {
                validate(field);
            }

            if (isFormValid) {
                if (!isValid(field)) {
                    isFormValid = false;
                }
            }
        }
    });

    if (isFormValid) {
        this.submit();
    }
});

function validate(field)
{
    switch (field.id) {
        case 'sku':
            checkForPresence(field);
            break;
        case 'name':
            checkForPresence(field);
            break;
        case 'price':
            checkForPresence(field);
            if (isValid(field)) {
                checkByPattern(field, /^((0\.)|([^0]\d*\.))\d{2}$/);
            }
            break;
        case 'weight':
            checkForPresence(field);
            if (isValid(field)) {
                checkByPattern(field, /^((0\.[^0])|([^0]\d*)(\.[^0])?)$/);
            }
            break;
        case 'size':
        case 'height':
        case 'width':
        case 'length':
            checkForPresence(field);
            if (isValid(field)) {
                checkByPattern(field, /^[^0]\d*$/);
            }
            break;
    }
}

function checkForPresence(field)
{
    field.classList.add('was-validated');

    if (field.value == '') {
        field.classList.remove('is-valid');
        field.classList.add('is-invalid');
        document.getElementById(field.id + 'Error').innerText = 'Please, submit required data.';
    } else {
        field.classList.remove('is-invalid');
        field.classList.add('is-valid');
    }
}

function checkByPattern(field, pattern)
{
    if (!field.value.match(pattern)) {
        field.classList.remove('is-valid');
        field.classList.add('is-invalid');
        document.getElementById(field.id + 'Error').innerText = 'Please, provide the data of indicated type.';
    }
}

function isValid(field)
{
    return field.classList.contains('is-valid');
}