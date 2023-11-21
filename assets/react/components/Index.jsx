import React, {useEffect, useState} from "react";
import {Box, Button, Container, Typography} from "@mui/material";
import {fetchSemesters} from "../services/api/choice";
import IndexTable from "./indexTableContent/IndexTable";
import {fetchDefaultSemester} from "../services/api/api";
import SearchTags from "./Search/SearchTags";

function Index() {
    const [searchInput, setInput] = useState("")
    const [semestersList, setSemesterList] = useState();
    const [semester, setSemester] = useState();
    useEffect(() => {
        fetchDefaultSemester().then((data) => {
            setSemester(data);
        })
        fetchSemesters().then((data) => {
            setSemesterList(
                data["hydra:member"].map((semester) => (
                    <Button
                        sx={{
                        width: "12%",
                        mr: "3px",
                        fontSize: "2em",
                        backgroundColor: "accent.main",
                        color: "white"
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
            <SearchTags setInput={setInput}/>
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