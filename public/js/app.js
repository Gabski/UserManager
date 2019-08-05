let  postAjax = (url, data, success) => {
    let params = typeof data == 'string' ? data : Object.keys(data).map(
        function (k) {
            return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
        }
    ).join('&');
  
    let xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    xhr.open('POST', url);
    xhr.onreadystatechange = function () {
        if (xhr.readyState > 3 && xhr.status == 200) {
            success(xhr.responseText);
        }
    };
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(params);
    return xhr;
}

let getChild = function (element, clasName) {
    let finder;
    for (var i = 0; i < element.childNodes.length; i++) {
        if (element.childNodes[i].className == clasName) {
            finder = element.childNodes[i];
            break;
        }
    }
    return finder;
}

let serialize = function (form) {

    let serialized = [];

    for (let i = 0; i < form.elements.length; i++) {

        let field = form.elements[i];

        if (!field.name || field.disabled || field.type === 'file' || field.type === 'reset' || field.type === 'submit' || field.type === 'button') continue;

        if (field.type === 'select-multiple') {
            for (let n = 0; n < field.options.length; n++) {
                if (!field.options[n].selected) continue;
                serialized.push(encodeURIComponent(field.name) + "=" + encodeURIComponent(field.options[n].value));
            }
        } else if ((field.type !== 'checkbox' && field.type !== 'radio') || field.checked) {
            serialized.push(encodeURIComponent(field.name) + "=" + encodeURIComponent(field.value));
        }
    }

    return serialized.join('&');

};



let validate = function (form) {

    let valid = true;
    let error;
    for (var i = 0; i < form.elements.length; i++) {
        var field = form.elements[i];
        let t = field.checkValidity()

        error = getChild(field.parentElement, 'input-group__error'); 
  
        if (!t) {
            field.classList.add("invalid-field");
            field.classList.add("shake-animation");
            error.innerHTML = field.validationMessage;
            valid = false;
        } else {
            field.classList.remove("invalid-field");
            field.classList.remove("shake-animation");
            if(error != undefined){
                error.innerHTML = "";
            }
        }
    }

    return valid;
}


let register = (form, obj) => {
 
    if(obj.success !== undefined && obj.success === true){
        form.reset();
        alert("Rejestrowanie udane");
    }else{
        alert("Rejestrowanie nie udane");
    }
   
}



let save = (form, obj) => {
 
    if(obj.success !== undefined && obj.success === true){
       
        alert("Zapisano");
    }else{
        alert("Nie zapisano");
    }
   
}


let delete_user = (form, obj) => {
 
    if(obj.success !== undefined && obj.success === true){
        alert("Usunięto");
        window.location.assign("/admin")
    }else{
        alert("Nie usunięto");
    }
   
}



elements = document.querySelectorAll(".ajx");
for (var i = 0; i < elements.length; i++) {
    elements[i].addEventListener("click", function (e) {
        e.preventDefault();
        let form = this.parentElement;
        var formData = serialize(form);
        var valid = validate(form);
        if (valid) {
            postAjax(form.action, formData, function (data) {
                let json = JSON.parse(data);
                  if(json.callback != undefined){
                  eval(json.callback)(form, json);
                }
            });
        }
    });
}


