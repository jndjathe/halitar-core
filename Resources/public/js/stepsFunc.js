/**
 * Appelles toutes les commandes ajax
 * 
 * @param {type} cmds
 * @returns {undefined}
 */
function callAllFunction(cmds) {
    
    // On parcourt la liste des commandes et on les executent
    $.each(cmds, function (index, obj) {
                
        if (obj.useTimer) {
            // Execution d'un fonction avec un temps d'attente
            setTimeout(function () {
                defaultCallFunc(obj);
            }, obj.params.time);
            
        } else {
            // Execution normal
            defaultCallFunc(obj);
        }

    });
}

/**
 * Default call function
 * 
 * @param {type} obj
 * @returns {undefined}
 */
function defaultCallFunc(obj) {

    if (typeof (window[obj.cmd]) === "function") {
        window[obj.cmd](obj.params);
    } else {
        throw("Erreur.  La fonction JavaScript " + obj.cmd + " n'existe pas.");
    }
}

// Alerte reference
// http://t4t5.github.io/sweetalert/

/**
 * Alert function
 * 
 * @param {type} param
 * @returns {undefined}
 */
function alertFunc(param) {
    swal(param.msg);
}

/**
 * 
 * @param {type} param
 * @returns {undefined}
 */
function openAlertBoxFunc(param) {
    // param.alertType = warning, success, error, info
    swal(param.title, param.alertMsg, param.alertType);
}

/**
 * Redirection vers la page param.url
 * 
 * @param {type} param
 * @returns {undefined}
 */
function redirectFunc(param) {
    document.location.href = param.url;
}