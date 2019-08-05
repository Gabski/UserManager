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


let pop_alert = (mess, style) => {
    let alerts = document.querySelector("#alerts");

    let alert = document.createElement('div');
    alert.classList.add("alerts__alert");
    if(style !== undefined){
        alert.classList.add("alerts__alert--" + style);
    }
    alert.innerHTML = mess;
    alerts.appendChild(alert);
}




let register = (form, obj) => {
 
    if(obj.success !== undefined && obj.success === true){
        form.reset();
        pop_alert("Rejestrowanie udane, wysyłamy email");
    }else{
        pop_alert("Rejestrowanie nie udane");
    }
   
}



let save = (form, obj) => {
 
    if(obj.success !== undefined && obj.success === true){
       
        pop_alert("Zapisano");
    }else{
        pop_alert("Nie zapisano");
    }
   
}


let delete_user = (form, obj) => {
 
    if(obj.success !== undefined && obj.success === true){
        pop_alert("Usunięto");
        window.location.assign("/admin")
    }else{
        pop_alert("Nie usunięto");
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
        }else{
            pop_alert("Wprowadź dane poprawnie");
        }
    });
}



let select = document.getElementById("emplacement");
let add_form = document.getElementById("add_form");

select.addEventListener("change", function (e) {
    // pop_alert("jo");
   
    add_form.innerHTML = "";

    postAjax("/addons", {'id' : e.target.value}, function (data) {
        add_form.innerHTML += data;
    });

});

