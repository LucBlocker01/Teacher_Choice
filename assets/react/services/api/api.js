export function fetchMyChoice(){
    return fetch(`/api/choice/me`).then((response) => response.json());
}

export function fetchByApiUrl(urlApi){
    return fetch(`${urlApi}`).then((response) => response.json());
}

export function deleteChoiceById(id){
    return fetch(`/api/choices/${id}`, {method: 'DELETE'}).then((response) => response.json());
}