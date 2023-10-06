import React from "react"

function useGetMe(user, setUserData) {

    fetch("https://localhost:8000/api/me", { credentials: 'include' })
        .then((response) => {
            return response.json();
        }).then((data) => {
            setUserData(data);
        });
    return user;
}

export default useGetMe;