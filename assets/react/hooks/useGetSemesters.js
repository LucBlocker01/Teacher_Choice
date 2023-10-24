

function useGetSemesters(semester, setSemesterData) {
    fetch("api/semesters")
        .then((response) => {
            return response.json()
        }).then((data) => {
            setSemesterData(data);
        }
    )
    return semester;
}

export default useGetSemesters;