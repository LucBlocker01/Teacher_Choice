import {useEffect, useState} from "react"
import {createTheme, useMediaQuery} from "@mui/material";
import {Normal} from "../themes/Normal";
import {Dark} from "../themes/Dark";

function useTheme() {
    const prefersDarkMode = useMediaQuery("(prefers-color-scheme: dark)");
    const [isNormal, setIsNormal] = useState(prefersDarkMode);
    let [theme, setTheme] = useState(
        createTheme(Normal)
    );

    function toggleTheme() {
        setIsNormal(!isNormal);
        setTheme(
            createTheme(
                isNormal ? Normal : Dark
            )
        )
    }
    useEffect(() => {
        if (prefersDarkMode) {
            toggleTheme();
        }
    }, []);
    return {prefersDarkMode, isNormal, theme, toggleTheme}
}

export default useTheme;