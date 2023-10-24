import React, {useEffect, useState} from "react";
import {
    Badge,
    Box,
    Button,
    Container,
    Table,
    TableBody,
    TableCell,
    TableContainer,
    TableHead,
    TableRow
} from "@mui/material";
import {deleteChoiceById, fetchByApiUrl} from "../services/api/api";

function ChoiceItem({ data }) {
    // data -> id, nbGroupSelected, year, lessonInformation

    // OLD VERSION
    /*const [ lessonInformation, setLessonInformation ] = useState({}) ;
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
    }, [lessonInformation]);*/

    var attributed = 'non attribué';


    return (
        <TableRow>
            <TableCell component="th" scope="row">{data.lessonInformation.lesson.name}</TableCell>
            <TableCell align="right">{data.lessonInformation.lesson.subject.semester.name}</TableCell>
            <TableCell align="right">{data.lessonInformation.lesson.subject.name}</TableCell>
            <TableCell align="right">{data.nbGroupSelected}</TableCell>
            <TableCell align="right">{data.lessonInformation.nbGroups}</TableCell>
            <TableCell align="right">
                <Box sx={{
                    margin: "1%",
                    backgroundColor: "accent.main",
                    color: "secondary.main",
                    borderRadius: "5px",
                    textAlign: "center"
                }}>
                    {data.nbGroupAttributed ? data.nbGroupAttributed : 'non attribué'}
                </Box>
            </TableCell>
            <TableCell align="right">{data.lessonInformation.lessonType.name}</TableCell>
            <TableCell>
                <Button sx={{ border: 1 }}>Modifier</Button>
            </TableCell>
            <TableCell>
                <Button sx={{ border: 1 }} onClick={() => {
                    deleteChoiceById(data.id).then();
                    location.reload();
                }}>Supprimer</Button>
            </TableCell>
        </TableRow>
    );
}

export default ChoiceItem;