export const BASE_URL = "https://127.0.0.1:8000";

export function fetchMyChoice(){
    return fetch(`${BASE_URL}/api/choices/me`).then((response) => response.json());
}