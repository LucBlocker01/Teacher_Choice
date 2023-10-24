

function useGetSemesters() {
    return fetch("/api/semesters")
        .then((response) => {
            return response.json()
        })
}

export default useGetSemesters;