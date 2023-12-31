export const BASE_URL = '127.0.0.1:8000/';

export function fetchSemesters() {
    return fetch('/api/semesters').then(response => response.json());
}

export function fetchSubjectBySemester(id) {
    return fetch(`/api/subjects/semester/${id}`).then(response => response.json());
}

export function fetchLessonBySubject(id) {
    return fetch(`/api/lessons/subject/${id}`).then(response => response.json());
}

export function postChoice(data) {
    return fetch('/api/choices', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(response => response);
}