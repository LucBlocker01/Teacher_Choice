import React from "react";
import Header from "../components/Header";
import {Normal} from "../themes/Normal";
import {createTheme, ThemeProvider} from "@mui/material";
import useTheme from "../hooks/useTheme";
import CssBaseline from "@mui/material/CssBaseline";
import Backtrack from "./Backtrack";
function AppBar() {
    const {isNormal, theme, toggleTheme} = useTheme();
    return(
        <ThemeProvider theme={theme}>
            <CssBaseline />
            <Header toggleTheme={toggleTheme} isNormal={isNormal}></Header>
            <Backtrack></Backtrack>
        </ThemeProvider>
    )
}
export default AppBar;