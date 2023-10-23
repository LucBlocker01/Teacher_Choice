import React, {useEffect, useState} from 'react'
import {AppBar, Box, Button, Container} from "@mui/material";
import useGetMe from "../hooks/useGetMe";


function Header() {
    const [user, setUserData] = useState({});
        useEffect(() => {
            async function grabUser() {
                await useGetMe(user, setUserData);
            }
            grabUser();
        }, []);
        console.log(user.status);
    return (
        <Box sx={{
            mb: "100px",
        }}>

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
                    {user.status === "/api/statuses/1"? <Button sx={{
                        color: "white",
                    }}
                    ><a href="/excel">Excel</a></Button>: null }

                    <Button sx={{
                        color: "white",
                    }}><a href={`/profil/${user.id}`}>Profil</a></Button>
                </Container>

            </AppBar>
        </Box>
    )
}


export default Header;