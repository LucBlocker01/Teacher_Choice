import {useEffect, useState} from "react"
import {createTheme, useMediaQuery} from "@mui/material";
import {Normal} from "../themes/Normal";
import {Dark} from "../themes/Dark";

function useTheme() {
    const prefersDarkMode = useMediaQuery("(prefers-color-scheme: dark)");
    const [isNormal, setIsNormal] = useState(() => {
        if (window.localStorage.getItem("theme") === "dark") {
            return false
        } else {
            return true
        }
    });
    let [theme, setTheme] = useState(() => {
        if (window.localStorage.getItem("theme") === "dark") {
            return createTheme({
                ...Dark
            })
        } else {
            return createTheme({
                ...Normal
            })
        }
        }
    );

    function toggleTheme() {
        setIsNormal(!isNormal);
        setTheme(
            createTheme(
                isNormal ?
                    {
                    ...Dark
                } : {
                    ...Normal
                }
            )
        )
        if (isNormal) {
            window.localStorage.setItem("theme", "dark")
        } else {
            window.localStorage.setItem("theme", "light")
        }

    }

    return {prefersDarkMode, isNormal, theme, toggleTheme}
}

export default useTheme;