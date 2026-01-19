# Use the official MySQL image from Docker Hub
FROM mysql:8.0

# Set environment variables (change as needed)
ENV MYSQL_ROOT_PASSWORD=root
ENV MYSQL_DATABASE=geoprofs
ENV MYSQL_USER=admin
ENV MYSQL_PASSWORD=

# Copy any custom SQL files (optional)
# These will be run automatically at container startup
# COPY ./init.sql /docker-entrypoint-initdb.d/

# Expose the default MySQL port
EXPOSE 3306
