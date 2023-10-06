export function fetchMyChoice(){
    return fetch('api/choices/me').then((response) => response.json());
}