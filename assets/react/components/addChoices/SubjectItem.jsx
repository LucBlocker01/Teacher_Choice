import React, { useState } from 'react'
import { fetchLessonBySubject } from "../../services/api/choice";
import LessonList from "./LessonList";

function SubjectItem({ data }) {

    const [lessons, setLessons] = useState(null);

    const SubjectClick = () => {
        console.log(data.id);
        fetchLessonBySubject(data.id).then((data) => {
            setLessons(data["hydra:member"].map((lesson) => (
                <LessonList key={lesson.id} data={lesson} />
            )));
        });
    }

  return (
    <div className={data.id}>
        <span onClick={SubjectClick}>{data.name}</span>
        <div>
            {lessons}
        </div>
    </div>
  )
}

export default SubjectItem