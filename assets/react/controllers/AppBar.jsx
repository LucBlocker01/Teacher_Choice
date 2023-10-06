import React from "react";
import Header from "../components/Header";
import {Normal} from "../themes/Normal";
import {createTheme, ThemeProvider} from "@mui/material";
function AppBar() {
    const theme = createTheme(Normal);
    return(
        <ThemeProvider theme={theme}>
            <Header/>
        </ThemeProvider>
    )
}
export default AppBar;