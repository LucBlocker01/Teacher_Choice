import React, {useEffect, useState} from "react";
import {Box, Button, Container, Table, TableBody, TableCell, TableContainer, TableHead, TableRow} from "@mui/material";
import { fetchByApiUrl } from "../services/api/api";

function ChoiceItem({ data }) {
    // data -> id, nbGroupSelected, year, lessonInformation

    const [ lessonInformation, setLessonInformation ] = useState({}) ;
    const [ lesson, setLesson ] = useState({}) ;
    const [ subject, setSubject ] = useState({}) ;
    const [ type, setType ] = useState({}) ;
    console.log(lessonInformation);
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
        if (lessonInformation.lessonType){
            fetchByApiUrl(lessonInformation.lessonType).then((dataType) => setType(dataType))
        }
    }, [lessonInformation]);

    // console.log(lessonInformation);
    return (
        <TableRow>
            <TableCell component="th" scope="row">{lesson.name}</TableCell>
            <TableCell align="right">{subject.name}</TableCell>
            <TableCell align="right">{data.nbGroupSelected}</TableCell>
            <TableCell align="right">{lessonInformation.nbGroups}</TableCell>
            <TableCell align="right">{type.name}</TableCell>
            <TableCell>
                <Button sx={{ border: 1 }}>Modifier</Button>
            </TableCell>
            <TableCell>
                <Button sx={{ border: 1 }}>Supprimer</Button>
            </TableCell>
        </TableRow>
    );
}

export default ChoiceItem;