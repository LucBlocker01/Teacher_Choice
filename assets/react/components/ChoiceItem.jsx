import React, {useEffect, useState} from "react";
import {Button, Container} from "@mui/material";
import { fetchByApiUrl } from "../services/api/api";
function ChoiceItem({ data }) {
    // data -> id, nbGroupSelected, year, lessonInformation

    const [ lessonInformation, setLessonInformation ] = useState({}) ;
    const [ lesson, setLesson ] = useState({}) ;

    useEffect(() => {
        fetchByApiUrl(data.lessonInformation).then((dataInfo) => setLessonInformation(dataInfo))
    }, [data]);

    useEffect(() => {
        if (lessonInformation.lesson !== undefined) {
            console.log(lessonInformation.lesson);
            fetchByApiUrl(lessonInformation.lesson).then((dataLesson) => setLesson(dataLesson))
        }
    }, [lessonInformation]);

    // console.log(lessonInformation);
    console.log(lesson);
    return (
        <Container id={data.id} sx={{
            backgroundColor: "secondary.main",
            margin: "1%"
        }}>
            <div>{data.year}</div>
            <div>{data.nbGroupSelected}</div>
            <div>{lessonInformation.id}</div>
            <Button sx={{
                border: 1,
                backgroundColor: "primary.main",
                color: "secondary.main",
                borderColor: "secondary.main"
            }}>Modifier</Button>
        </Container>
    );
}

export default ChoiceItem;