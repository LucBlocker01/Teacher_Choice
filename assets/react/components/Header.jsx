import React from 'react'
import {AppBar, Box} from "@mui/material";


function Header() {
    return(
        <Box sx={{mb: "100px",}} >
            <AppBar><h1>React App</h1></AppBar>
        </Box>
    )
}


export default Header;