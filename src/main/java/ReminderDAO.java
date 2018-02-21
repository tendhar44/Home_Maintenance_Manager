import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.Date;
import java.util.List;

public class ReminderDAO {

	private final static String host = "jdbc:mysql://localhost/test";
	private final static String username = "root";
	private final static String password = "";
	private static Connection conconnection;
	private Statement statement;
	private ResultSet resultSet;

	
	public ReminderDAO() {
		connectToDatabase();
	}
	
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
	
	public List<TaskRecord> getAllTaskRecords() {
		
		return null;
	}
	
	public User getUser(String taskID) {
		
		return null;
	}
	
	public Task getTask(String taskID) {
		
		return null;
	}
	
	public boolean updateTask(String taskID) {
		
		return false;
	}
	
}
