import React from "react"

function useGetMe(user, setUserData) {

    fetch("/api/me", { credentials: 'include' })
        .then((response) => {
            return response.json();
        }).then((data) => {
            setUserData(data);
        });
    return user;
}

export default useGetMe;