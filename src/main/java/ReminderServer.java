import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.Date;

public class ReminderServer {

	private final static String host = "jdbc:mysql://localhost/test";
	private final static String username = "root";
	private final static String password = "";
	private static Connection conconnection;
	private Statement statement;
	private ResultSet resultSet;

	private void connectToDatabase() {

		// Connecting to the database
		try {
			conconnection = DriverManager.getConnection(host, username, password);
			System.out.println("Connection Object Created : " + conconnection);

			statement = conconnection.createStatement();
			String sql = "";
			resultSet = statement.executeQuery(sql);

			while (resultSet.next()) {

			}

			conconnection.close();

		} catch (SQLException ex) {
			System.out.println(ex.getMessage());
		}

	}

	private String processReminder() {

		return "";
	}

	private boolean sendReminder() {

		return false;

	}

	private boolean updateReminder() {

		return false;
	}
	
	private Date checkDueDate() {
		
		return null;
	}
}