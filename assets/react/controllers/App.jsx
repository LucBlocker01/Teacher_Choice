import React from "react";
import Header from "../components/Header";
import {ThemeProvider} from "@mui/material";
import useTheme from "../hooks/useTheme"
import Home from "../components/Home";
import {Route, Router} from "wouter";
import Choices from "../components/Choices";
import CssBaseline from '@mui/material/CssBaseline';
import AddChoices from "../components/addChoices/AddChoices";

function App() {
    const {isNormal, theme, toggleTheme} = useTheme();
    return (
        <ThemeProvider theme={theme}>
            <CssBaseline />
            <Header toggleTheme={toggleTheme}></Header>
            <Router>
                <Route path="/react" component={Home}/>
                <Route path="/react/choices" component={Choices}/>
                <Route path="/react/choices/add" component={AddChoices}/>
            </Router>
        </ThemeProvider>
    );
}

export default App;
