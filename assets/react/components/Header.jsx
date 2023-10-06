import React from 'react'
import {AppBar, Box, Button, Container} from "@mui/material";


function Header() {
    return(
        <Box sx={{
            mb: "100px",
        }} >

            <AppBar sx={{
                display: "flex",
                flexDirection: "row",
            }}>
                <Container sx={{
                    m: '0'
                }}>
                    <p>SetURCAlendar</p>
                </Container>
                <Container sx={{
                    display: "flex",
                    justifyContent: "flex-end",
                }}>
                    <Button sx={{
                        color:"white",
                    }}><a>Profil</a></Button>
                </Container>

            </AppBar>
        </Box>
    )
}


export default Header;