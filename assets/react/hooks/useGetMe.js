import React from "react"

function useGetMe() {
    return fetch("/api/me", { credentials: 'include' })
        .then((response) => {
            if (response.status === 401) {
                return Promise.resolve(null);
            }
            return response.json();
        });
}

export default useGetMe;