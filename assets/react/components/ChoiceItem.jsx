import React, {useEffect, useState} from "react";
import {Button, Container} from "@mui/material";
import { fetchByApiUrl } from "../services/api/api";
function ChoiceItem({ data }) {
    // data -> id, nbGroupSelected, year, lessonInformation

    const [ lessonInformation, setLessonInformation ] = useState({}) ;
    const [ lesson, setLesson ] = useState({}) ;
    const [ subject, setSubject ] = useState({}) ;
    const [ semester, setSemester ] = useState({}) ;

    useEffect(() => {
        fetchByApiUrl(data.lessonInformation).then((dataInfo) => setLessonInformation(dataInfo))
    }, [data]);

    useEffect(() => {
        if (lessonInformation.lesson !== undefined) {
            fetchByApiUrl(lessonInformation.lesson).then((dataLesson) => setLesson(dataLesson))
        }
    }, [lessonInformation]);

    useEffect(() => {
        if (lesson.subject !== undefined) {
            fetchByApiUrl(lesson.subject).then((dataSubject) => setSubject(dataSubject))
        }
    }, [lesson]);

    useEffect(() => {
        if (subject.semester !== undefined) {
            fetchByApiUrl(subject.semester).then((dataSemester) => setSemester(dataSemester))
        }
    }, [subject]);

    // console.log(lessonInformation);
    return (
        <Container id={data.id} sx={{
            backgroundColor: "secondary.main",
            margin: "10px",
            display: "flex"
        }}>
            <Container sx={{
                margin: "10px",
                display: "flex",
                flexDirection: "column"
            }}>
                <div>{data.year}</div>
                <div>{data.nbGroupSelected}</div>
                <div>{lesson.name}</div>
                <div>{subject.name}</div>
                <div>{semester.name}</div>
            </Container>
            <Button sx={{
                border: 1,
                backgroundColor: "secondary.main"
            }}>Modifier</Button>
        </Container>
    );
}

export default ChoiceItem;