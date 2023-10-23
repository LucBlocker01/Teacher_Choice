import React, { useState } from 'react'
import { fetchSubjectBySemester } from "../../services/api/choice";
import LessonItem from "./LessonItem";

function SubjectItem({ data }) {

    const [lessons, setLessons] = useState(null);

    const SubjectClick = () => {
        console.log(data.id);
        //fetchLessonBySubject a faire en back
        fetchSubjectBySemester(1).then((data) => {
            setLessons(data["hydra:member"].map((lesson) => (
                <LessonItem key={lesson.id} data={lesson} />
            )));
        });
    }

  return (
    <div onClick={SubjectClick}>{data.name}
        {lessons}
    </div>
  )
}

export default SubjectItem