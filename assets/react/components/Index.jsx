import React, {useEffect, useState} from "react";
import {Box, Button, Container, Typography} from "@mui/material";
import {fetchSemesters} from "../services/api/choice";
import IndexTable from "./indexTableContent/IndexTable";
import {fetchDefaultSemester, fetchSemesterByYear} from "../services/api/api";
import SearchTags from "./Search/SearchTags";
import {getCurrentYear} from "../partials/currentYear";

function Index() {
    const [searchInput, setInput] = useState("")
    const [semestersList, setSemesterList] = useState();
    const [semester, setSemester] = useState();

    //Get current month and years
    const currentYear =  getCurrentYear();

    useEffect(() => {
        fetchDefaultSemester().then((data) => {
            setSemester(data);
        })
        fetchSemesterByYear(currentYear).then((data) => {
            setSemesterList(
                data["hydra:member"].map((semester) => (
                    <Button
                        sx={{
                        width: "12%",
                        mr: "3px",
                        fontSize: "2em",
                        backgroundColor: "accent.main",
                        color: "text.main"
                    }}
                        key={semester.id}
                        onClick={() => {
                            setSemester(semester)
                        }}>
                        {semester.name}
                    </Button>
                ))
            )
        })
        document.title = "SetURCAlendar - Accueil"
    }, []);
    return(
        <Box sx={{
            mb: "100px",
        }}>
            <Typography variant="h1" sx={{
                textAlign: "center",
                color: "text.main",
                fontSize: "50px",
                fontWeight: "bold",
            }}>Set<a className="title_color_2">URCA</a>lendar</Typography>
            <Box sx={{
                display: "flex",
                justifyContent: "center",
                mb: "5px"
            }}>
                {semestersList}
            </Box>
            <Box sx={{
                display: "flex",
                justifyContent: "center",
                mb: "5px"
            }}>
                <SearchTags setInput={setInput}/>
            </Box>
            <Container sx={{
                display: "flex",
                alignItems: "center",
                justifyContent: "space-around",
                flexWrap: "wrap",
                flexDirection: "column"
            }}>
                <IndexTable semester={semester} searchInput={searchInput}/>
            </Container>

        </Box>
    )
}

export default Index;