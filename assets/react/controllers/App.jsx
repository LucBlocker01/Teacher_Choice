import React from "react";
import Header from "../components/Header";
import {createTheme, ThemeProvider} from "@mui/material";
import {Normal} from "../themes/Normal";
import {Dark} from "../themes/Dark";
import Home from "../components/Home";
import {Route, Router} from "wouter";
import Choices from "../components/Choices";
import CssBaseline from '@mui/material/CssBaseline';

function App() {
    const theme = createTheme(Normal);
    return (
        <ThemeProvider theme={theme}>
            <CssBaseline />
            <Header></Header>
            <Router>
                <Route path="/react" component={Home}/>
                <Route path="/react/choices" component={Choices}/>
            </Router>
        </ThemeProvider>
    );
}

export default App;
