import React from 'react'
import {Button} from "@mui/material";

function Backtrack() {
    function handleClick() {
        window.history.back()
        window.localStorage.setItem("refresh", "true")
    }
    return (
            <Button sx={{
                backgroundColor : "primary.main",
                color : "text.main",
                ml : "1%"
            }} onClick={handleClick}>
                Retour
            </Button>

    )
}

export default Backtrack