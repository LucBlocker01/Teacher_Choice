import React, {useEffect, useState} from 'react'
import {AppBar, Box, Button, Container, Link} from "@mui/material";
import useGetMe from "../hooks/useGetMe";
import AdminPanelSettingsIcon from '@mui/icons-material/AdminPanelSettings';
import NightlightRoundIcon from '@mui/icons-material/NightlightRound';
import WbSunnyIcon from '@mui/icons-material/WbSunny';
import PersonIcon from '@mui/icons-material/Person';
import LoginIcon from '@mui/icons-material/Login';
import LogoutIcon from '@mui/icons-material/Logout';
import ChecklistIcon from '@mui/icons-material/Checklist';
import ImportExportIcon from '@mui/icons-material/ImportExport';

function Header({toggleTheme, isNormal}) {
    const [user, setUserData] = useState({});

    useEffect(() => {
        useGetMe().then((data) => {
            setUserData(data);
        })
    }, [])

    console.log(user?.status?.name)

    return (
        <Box sx={{
            mb: "100px",
        }}>

            <AppBar sx={{
                display: "flex",
                flexDirection: "row",
                alignItems: "center",
                backgroundColor: "primary.main",
            }}>
                <Container sx={{
                    m: '0',
                    display: "flex",
                    alignItems: "center"
                }}>
                    <Link href="/">
                        <img className="logo_header" src="/img/urca.png" alt="urca-logo" />
                    </Link>
                    ACCEUIL
                </Container>
                <Container sx={{
                    display: "flex",
                    justifyContent: "flex-end",
                }}>
                    {user !== null && user?.status?.name === "Admin" ? <Link sx={{
                        textDecoration: "none",
                        mr: "5px",
                        "&:hover" : {
                            backgroundColor: "secondary.main",
                            borderRadius: "4px",
                        }
                    }} href="/excel">
                        <Button sx={{
                        backgroundColor: "accent.main",
                        color: "white",
                        }}
                        >
                            <ImportExportIcon></ImportExportIcon>
                            Import/Export Excel
                        </Button>
                    </Link>
                        : null
                    }
                    {user !== null && user?.status?.name === "Admin" ?
                        <Link sx={{
                        textDecoration: "none",
                        mr: "5px",
                        "&:hover" : {
                            backgroundColor: "secondary.main",
                            borderRadius: "4px",
                        }
                    }} href="/admin">
                        <Button sx={{
                            backgroundColor: "accent.main",
                            color: "white",
                        }}
                        title="Admin">
                            <AdminPanelSettingsIcon></AdminPanelSettingsIcon>
                            Admin
                        </Button>
                        </Link>
                        : null }
                    <Button sx={{
                        backgroundColor: "accent.main",
                        color: "white",
                        mr: "5px",
                        "&:hover" : {
                            backgroundColor: "secondary.main",
                            borderRadius: "4px",
                        }
                    }}
                            onClick={toggleTheme}
                            title={"Changer thème"}
                    >{isNormal ?
                        <>
                            <WbSunnyIcon></WbSunnyIcon>
                            <Box>Mode Clair</Box>
                        </>
                     :
                        <>
                            <NightlightRoundIcon></NightlightRoundIcon>
                            Mode Sombre
                        </>
                    } </Button>
                    { user !== null ?
                        <Link sx={{
                            textDecoration: "none",
                            mr: "5px",
                            "&:hover" : {
                                backgroundColor: "secondary.main",
                                borderRadius: "4px",
                            }
                        }} href={`/profil/${user.id}`}>
                            <Button sx={{
                                backgroundColor: "accent.main",
                                color: "white",
                            }}
                            title="Profil">
                                <PersonIcon></PersonIcon>
                                Profil
                            </Button></Link> :
                        <Link sx={{
                            textDecoration: "none",
                            "&:hover" : {
                                backgroundColor: "secondary.main",
                                borderRadius: "4px",
                            }
                        }} href={`/login`}>
                            <Button sx={{
                                backgroundColor: "accent.main",
                                color: "white",
                            }}
                            >
                                <LoginIcon></LoginIcon>
                                connexion
                            </Button></Link>}
                    { user !== null && user?.status?.name !== "Admin" ?
                        <Link href="/react/choices">
                            <Button sx={{
                                backgroundColor: "accent.main",
                                color: "white",
                                textDecoration: "none",
                                mr: "5px",
                                "&:hover" : {
                                    backgroundColor: "secondary.main",
                                    borderRadius: "4px",
                                }
                        }} title="Voeux"
                        >
                            <ChecklistIcon />
                            VOEUX
                        </Button>
                    </Link> : ""}
                    { user !== null ?
                        <Link sx={{
                            textDecoration: "none",
                            "&:hover" : {
                                backgroundColor: "secondary.main",
                                borderRadius: "4px",
                            }
                        }} href={`/logout`}>
                            <Button sx={{
                                backgroundColor: "accent.main",
                                color: "white",
                            }}
                            title="Logout">
                                <LogoutIcon></LogoutIcon>
                                Deconnexion
                            </Button>
                        </Link>
                            : null }
                </Container>
            </AppBar>
        </Box>
    )
}


export default Header;