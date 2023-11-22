import React from 'react'
import {Button, ThemeProvider} from "@mui/material";
import useTheme from "../hooks/useTheme"
import CssBaseline from "@mui/material/CssBaseline";

function Backtrack() {
    const {theme} = useTheme();
    function handleClick() {
        window.history.back()
    }
    return (
            <Button onClick={handleClick}>
                Retour
            </Button>

    )
}

export default Backtrack