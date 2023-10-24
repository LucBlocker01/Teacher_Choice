import React from "react";
import Header from "../components/Header";
import {createTheme, ThemeProvider} from "@mui/material";
import {Normal} from "../themes/Normal";
import Home from "../components/Home";
import {Route, Router} from "wouter";
import Choices from "../components/Choices";

function App() {
    const theme = createTheme(Normal);
    return (
        <ThemeProvider theme={theme}>
            <Header></Header>
            <Router>
                <Route path="/react" component={Home}/>
                <Route path="/react/choices" component={Choices}/>
            </Router>
        </ThemeProvider>
    );
}

export default App;
