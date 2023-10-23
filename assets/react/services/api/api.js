export function fetchMyChoice(){
    return fetch(`/api/choice/me`).then((response) => response.json());
}

export function fetchByApiUrl(urlApi){
    return fetch(`${urlApi}`).then((response) => response.json());
}