export const BASE_URL = '127.0.0.1:8000/';

export function fetchSemesters() {
    return fetch('/api/semesters').then(response => response.json());
}