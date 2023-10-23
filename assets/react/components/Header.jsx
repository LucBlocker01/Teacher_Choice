import React, {useEffect, useState} from 'react'
import {AppBar, Box, Button, Container, Link} from "@mui/material";
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
                alignItems: "center",
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
                    {user.status === "/api/statuses/1" ? <Link sx={{
                        textDecoration: "none",
                        mr: "3px",
                        "&:hover" : {
                            backgroundColor: "secondary.main",
                            borderRadius: "4px",
                        }
                    }} href="/excel">
                        <Button sx={{
                        backgroundColor: "accent.main",
                        color: "white",
                        }}
                        >Excel</Button></Link>: null }
                    <Link sx={{
                        textDecoration: "none",
                        "&:hover" : {
                            backgroundColor: "secondary.main",
                            borderRadius: "4px",
                        }
                    }} href={`/profil/${user.id}`}>
                    <Button sx={{
                        backgroundColor: "accent.main",
                        color: "white",
                    }}
                    >Profil</Button></Link>
                </Container>

            </AppBar>
        </Box>
    )
}


export default Header;