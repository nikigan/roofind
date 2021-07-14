import {
    Card,
    CardActionArea,
    CardContent,
    Container,
    Grid,
    Typography,
} from "@material-ui/core";
import axios from "../../src/services/base";
import { FC } from "react";
import { GetStaticProps } from "next";
import Project from "../../src/interfaces/project";
import Link from "next/link";

interface ProjectsProps {
    data: Project[];
}
const Projects: FC<ProjectsProps> = ({ data: projects }) => {
    return (
        <>
            <h1>Projects page</h1>
            <Grid container spacing={3}>
                {projects.map((project) => (
                    <Link key={project.id} href={`/projects/${project.id}`}>
                        <Grid item lg={4}>
                            <CardActionArea component="a">
                                <Card>
                                    <CardContent>
                                        <Typography variant="h5">
                                            {project.title}
                                        </Typography>
                                        <Typography variant="body2">
                                            {project.description}
                                        </Typography>
                                    </CardContent>
                                </Card>
                            </CardActionArea>
                        </Grid>
                    </Link>
                ))}
            </Grid>
        </>
    );
};

export const getStaticProps: GetStaticProps = async () => {
    const { data } = await axios.get("/projects");

    return {
        props: { ...data },
        revalidate: 1,
    };
};

export default Projects;
