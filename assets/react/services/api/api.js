export function fetchMyChoice(){
    return fetch(`/api/choice/me`).then((response) => response.json());
}

export function fetchTeacherChoice(id){
    return fetch(`/api/user/choice/${id}`).then((response) => response.json());
}
export function fetchTeachers(){
    return fetch(`/api/teachers`).then((response) => response.json());
}
export function fetchByApiUrl(urlApi){
    return fetch(`${urlApi}`).then((response) => response.json());
}

export function deleteChoiceById(id){
    return fetch(`/api/choices/${id}`, {method: 'DELETE'}).then((response) => response.json());
}

export function PatchTeacherChoiceById(id, nbGroupAttributed){
    return fetch(`/api/choices/${id}`,
        {
            headers: {
                Accept: "application/json",
                "Content-Type": "application/merge-patch+json"
            },
            method: 'PATCH',
            body: JSON.stringify({
                nbGroupAttributed: parseInt(nbGroupAttributed)
            })})
        .then((response) => response.json());
}
export function modifyChoiceById(id, nb){
    return fetch(`/api/choices/${id}`, {
        headers: {
            Accept: "application/json",
            "Content-Type": "application/merge-patch+json"
        },
        method: 'PATCH',
        body: JSON.stringify({
            nbGroupSelected: parseInt(nb),
        }),
    })
        .then((response) => response.json());
}

export function fetchAllWeeks(){
    return fetch(`/api/weeks`).then((response) => response.json());
}

export function fetchDefaultSemester() {
    return fetch('/api/semesters/1').then(response => response.json());
}

export function fetchOldChoices(){
    return fetch('/api/old_choices').then(response => response.json())
}

export function fetchSemesterByYear(year) {
    return fetch(`/api/semestersByYears/${year}`).then(response => response.json())
}