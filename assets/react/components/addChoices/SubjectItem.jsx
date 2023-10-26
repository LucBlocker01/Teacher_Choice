import React, {useEffect, useState} from 'react'
import { fetchLessonBySubject } from "../../services/api/choice";
import LessonList from "./LessonList";

function SubjectItem({ data, user }) {

    const [lessons, setLessons] = useState(null);

    useEffect(() => {
            const MR = data.name;
            setLessons(data["lessons"].map((lesson) => (
                <LessonList key={lesson.id} data={lesson} MR={MR} user={user} />
            )));
    }, []);

    if (lessons === null) {
        return <div>Loading...</div>;
    }

  return (
      <div>
          {lessons}
      </div>
  )
}

export default SubjectItem