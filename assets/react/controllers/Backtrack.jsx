import React from 'react'
import {Button, ThemeProvider} from "@mui/material";
import useTheme from "../hooks/useTheme"
import CssBaseline from "@mui/material/CssBaseline";

function Backtrack() {
    const {isNormal, theme, toggleTheme} = useTheme();
    function handleClick() {
        window.history.back()
    }
    return (
        <ThemeProvider theme={theme}>
            <CssBaseline />
            <Button onClick={handleClick}>
                Retour
            </Button>
        </ThemeProvider>

    )
}

export default Backtrack